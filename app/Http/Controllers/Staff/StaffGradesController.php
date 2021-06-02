<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffGenerateNotationSpreadsheetRequest;
use App\Models\Group;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StaffGradesController extends Controller
{
    public function home()
    {

        $earliestTask = Task::orderBy('ended_at')->whereNotNull('ended_at')->first();

        return view('staff.grades.home', ['earliestTask' => $earliestTask]);
    }

    public function generateSpreadSheet(StaffGenerateNotationSpreadsheetRequest $request)
    {
        $groups = Group::whereIn('id', $request->groups)->get();


        $matchingTasks = Task::query();
        $matchingTasks->whereNotNull('ended_at');
        $matchingTasks->where('notation_status', 'FINISHED');
        if ($request->start_date) {
            $startDate = new Carbon($request->start_date);
            $startDate->startOf('week');
            $matchingTasks->where('ended_at', '>', $startDate);
        }
        if ($request->end_date) {
            $endDate = new Carbon($request->end_date);
            $endDate->endOfWeek();
            $matchingTasks->where('ended_at', '<', $endDate);
        }

        $tasksIds = $matchingTasks->get()->pluck('id');
        if (count($tasksIds) == 0) {
            return redirect()->back()->with('error', 'Il n\'y à aucune tâche notée dans cet interval');
        }
        $spreadsheet = new Spreadsheet();
        foreach ($groups as $group) {
            $groupSheet = $spreadsheet->createSheet();
            $groupSheet->setTitle($group->name);
            // Headers
            $groupSheet->setCellValueByColumnAndRow(1, 1, $group->name);

            $weeks = (new Carbon($request->start_date))->diffInWeeks($request->end_date);
            $date = Carbon::now()->subtract('week', $weeks);

            for ($i = 0; $i <= $weeks; $i++) {
                $week = $date->clone()->add('week', $i);
                $startOfWeek = $week->clone()->startOfWeek();
                $endOfWeek = $week->clone()->endOfWeek();

                $groupSheet->setCellValueByColumnAndRow(3 + $i * 4, 1, "{$startOfWeek->format('d/m/y')} au {$endOfWeek->format('d/m/y')}");

                $groupSheet->mergeCellsByColumnAndRow(3 + $i * 4, 1, 3 + $i * 4 + 3, 1);

                $groupSheet->setCellValueByColumnAndRow(3 + $i * 4, 2, "2");
                $groupSheet->setCellValueByColumnAndRow(3 + $i * 4 + 1, 2, "1");
                $groupSheet->setCellValueByColumnAndRow(3 + $i * 4 + 2, 2, "0");
                $groupSheet->setCellValueByColumnAndRow(3 + $i * 4 + 3, 2, "Nbr Tâches");
            }

            // All users
            $groupUsers = $group->users()->get();


            foreach ($groupUsers as $key => $user) {
                $groupSheet = $groupSheet->setCellValueByColumnAndRow(1, $key + 3, $user->first_name);
                $groupSheet = $groupSheet->setCellValueByColumnAndRow(2, $key + 3, $user->last_name);

                $tasks = $user->tasks()->whereIn('task_id', $tasksIds)->get();
                for ($i = 0; $i <= $weeks; $i++) {
                    $week = $date->clone()->add('week', $i);
                    $startOfWeek = $week->clone()->startOfWeek();
                    $endOfWeek = $week->clone()->endOfWeek();
                    $tasksInWeek = $tasks->filter(function ($task) use ($startOfWeek, $endOfWeek, $i) {
                        return $task->ended_at->between($startOfWeek, $endOfWeek);
                    });


                    $summary = $tasksInWeek->reduce(function ($carry, $task) use ($user) {
                        $grade = $task->grades('user_id', $user->id)->where('evaluation_type', 'STAFF')->first();
                        if (!$grade) {
                            return $carry;
                        }
                        if ($grade->grade == 2) {
                            $carry['stars_two']++;
                        } elseif ($grade->grade == 1) {
                            $carry['stars_one']++;
                        } elseif ($grade->grade == 0) {
                            $carry['stars_zero']++;
                        }
                        return $carry;
                    }, ['stars_two' => 0, 'stars_one' => 0, 'stars_zero' => 0]);

                    $groupSheet->setCellValueByColumnAndRow(3 + $i * 4, $key + 3, $summary['stars_two']);
                    $groupSheet->setCellValueByColumnAndRow(3 + $i * 4 + 1, $key + 3, $summary['stars_one']);
                    $groupSheet->setCellValueByColumnAndRow(3 + $i * 4 + 2, $key + 3, $summary['stars_zero']);
                    $groupSheet->setCellValueByColumnAndRow(3 + $i * 4 + 3, $key + 3, $tasksInWeek->count());
                }
                // User summary

                $formula = "=";
                for ($i = 0; $i <= $weeks; $i++) {
                    $formula .= "4*" . $groupSheet->getCellByColumnAndRow(3 + $i * 4, $key + 3)->getCoordinate() . "+" . $groupSheet->getCellByColumnAndRow(3 + $i * 4 + 1, $key + 3)->getCoordinate();
                    if ($weeks - $i != 1) {
                        $formula .= "+";
                    }
                }
                $groupSheet->setCellValueByColumnAndRow(3 + ($weeks + 1) * 4 + 1, $key + 3, "Note:");
                // $groupSheet->setCellValueByColumnAndRow(3 + ($weeks + 1) * 4 + 2, $key + 3, $formula);


            }

            foreach (range('A', 'Z') as $letter) {
                $groupSheet->getColumnDimension($letter)->setAutoSize(true);
                foreach (range('A', 'Z') as $sLetter) {
                    $groupSheet->getColumnDimension($letter . $sLetter)->setAutoSize(true);
                }
            }

        }
        $spreadsheet->removeSheetByIndex(0);
        $writer = new Xlsx($spreadsheet);
        $response = new StreamedResponse(
            function () use ($writer) {
                $writer->save('php://output');
            }
        );

        $date = date('y-m-d');
        $filename = "export-$date.xlsx";
        $response->headers->set('Content-Type', 'application/vnd.ms-excel');
        $response->headers->set('Content-Disposition', "attachment;filename=\"$filename\"");
        $response->headers->set('Cache-Control', 'max-age=0');
        return $response;
    }
}
