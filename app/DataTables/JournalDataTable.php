<?php

namespace App\DataTables;

use App\Models\Journal;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class JournalDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('title', function (Journal $journal) {
                return '<a href="javascript:void(0)" class="btn btn-sm text-line-clamp"
                                data-url="' . route('journals.edit', $journal->id) . '"
                                data-size="lg" data-ajax-popup="true"
                                data-title="' . __('Edit Journal') . '">
                                ' . htmlspecialchars($journal->title) . '
                            </a>';
            })
            ->editColumn('site_link', function (Journal $journal) {
                return '<a href="' . $journal->site_link . '" class="btn btn-sm text-line-clamp" target="_blank">
                                ' . htmlspecialchars($journal->site_link) . '
                            </a>';
            })
            ->addColumn('action', function (Journal $journal) {
                return view('libraries.journal.action', compact('journal'));
            })
            ->rawColumns(['title', 'site_link', 'action']);
    }

    public function query(Journal $model): QueryBuilder
    {
        return $model->newQuery()->where('created_by', Auth::user()->id);
    }

    public function html(): HtmlBuilder
    {
        $dataTable = $this->builder()
            ->setTableId('journal-table')
            ->columns($this->getColumns())
            ->orderBy(1)
            ->language([
                "paginate" => [
                    "previous" => 'Prev'
                ],
                'lengthMenu' => __('Show ') . __("_MENU_") . __(' entries'),
            ]);

        $dataTable->parameters([
            "dom" =>  "
                <'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>
                <'dataTable-container'<'col-sm-12'tr>>
                <'row'<'col-sm-5'i><'col-sm-7'p>>
            ",
            'buttons' => [],
            "drawCallback" => 'function( settings ) {
                var tooltipTriggerList = [].slice.call(
                    document.querySelectorAll("[data-bs-toggle=tooltip]")
                );
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
                var popoverTriggerList = [].slice.call(
                    document.querySelectorAll("[data-bs-toggle=popover]")
                );
                var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                    return new bootstrap.Popover(popoverTriggerEl);
                });
                var toastElList = [].slice.call(document.querySelectorAll(".toast"));
                var toastList = toastElList.map(function (toastEl) {
                    return new bootstrap.Toast(toastEl);
                });

                var columnIndex = 0; // Change this to your column index
            }'
        ]);

        return $dataTable;
    }

    protected function getColumns(): array
    {
        return [
            Column::make('No')->title(__('#'))->data('DT_RowIndex')->name('DT_RowIndex')->searchable(false)->orderable(false),
            Column::make('title')->title(__('Title')),
            Column::make('site_link')->title(__('Site Link')),
            Column::computed('action')->title(__('Action'))
                ->exportable(false)
                ->printable(false)
                ->width(120),
        ];
    }

    protected function filename(): string
    {
        return 'Journal_' . date('YmdHis');
    }
}
