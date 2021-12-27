<?php

namespace App\DataTables;

use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use App\Models\Post;

class PostsDatatable extends DataTable
{
    public function dataTable($query) {
        return datatables($query)
            ->setRowId('id')
            ->addIndexColumn()
            ->addColumn('created_at', function (Post $post){ return Carbon::parse($post->created_at)->isoFormat('Do MMMM YYYY');})
            ->addColumn('attachments', function (Post $post){
                $data = '';
                foreach($post->attachments as $attachment){
                    $data .= '
                    <a href="'.$attachment->file_path.'" data-lity>
                        <img src="'.$attachment->file_path.'"  style="width: 100px; height: 85px;" class="img-thumbnail">
                    </a>';
                }
                return $data;
            })
            ->addColumn('checkbox', 'posts.btn.checkbox')
            ->addColumn('edit', 'posts.btn.edit')
            ->addColumn('delete', 'posts.btn.delete')
            ->rawColumns([
                'edit',
                'delete',
                'checkbox',
                'attachments'
            ]);

    }
    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        return Post::with('attachments');
    }


    // datatables languages
    public static function lang(): array
    {
        $langJson = [
            'sProcessing'         => trans('admin.sProcessing'),
            'sLengthMenu'         => trans('admin.sLengthMenu'),
            'sZeroRecords'        => trans('admin.sZeroRecords'),
            'sEmptyTable'         => trans('admin.sEmptyTable'),
            'sInfo'               => trans('admin.sInfo'),
            'sInfoEmpty'          => trans('admin.sInfoEmpty'),
            'sInfoFiltered'       => trans('admin.sInfoFiltered'),
            'sInfoPostFix'        => trans('admin.sInfoPostFix'),
            'sSearch'             => trans('admin.sSearch'),
            'sUrl'                => trans('admin.sUrl'),
            'sInfoThousands'      => trans('admin.sInfoThousands'),
            'sLoadingRecords'     => trans('admin.sLoadingRecords'),
            'oPaginate'           => [
                'sFirst'                => trans('admin.sFirst'),
                'sLast'                 => trans('admin.sLast'),
                'sNext'                 => trans('admin.sNext'),
                'sPrevious'             => trans('admin.sPrevious'),
            ],

            'oAria'               => [
                'sSortAscending'        => trans('admin.sProcessing'),
                'sSortDescending'       => trans('admin.sProcessing'),
            ],

        ];
        return $langJson;
    }


    public function html(): \Yajra\DataTables\Html\Builder
    {
        return $this->builder()
            ->setTableId('posts-datatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Blfrtip')
            ->orderBy(1)
            ->lengthMenu([[25,50,100,-1],[25,50,100,trans('All Records')]])
            ->buttons(
                Button::make()->addClass('btn  btn-outline-blue  add-admin mb-3')
                    ->text('<i class="fa fa-plus"></i>'. trans('admin.add_post'))
                    ->attr(['data-bs-toggle' => 'tooltip' ,'data-bs-placement' => 'bottom' , 'title' => trans('admin.add_post')])
                    ->action( "function (){
                        window.location.href= '".route('posts.create')."'
                    }"),
                Button::make('print' ) ->className('btn  btn-outline-blue btn_size  mr-1 ') ->attr(['data-bs-toggle' => 'tooltip' ,'data-bs-placement' => 'bottom' , 'title' => 'طباعة']) ->text('<i class="bi bi-printer"></i> '),
                Button::make('excel' ) ->className('btn  btn-outline-blue btn_size excel-btn')->attr(['data-bs-toggle' => 'tooltip' ,'data-bs-placement' => 'bottom' , 'title' => 'تحميل كملف أكسيل']) ->text('<img class="excel-btn-img" src="'.asset('template_files/dist/img/icons/export-excel.png').'">'),
                Button::make()->className('btn btn-outline-danger del_btn btn_size mx-1')->attr(['data-bs-toggle' => 'tooltip' ,'data-bs-placement' => 'bottom' , 'title' => 'حذف متعدد']) ->text(' <i class="bi bi-trash"></i>')
                )
            ->initComplete("function () {
                this.api().columns([]).every(function () {
                    var column = this;
                    var input = document.createElement(\"input\");
                    $(input).appendTo($(column.footer()).empty())
                    .on('keyup', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });
                });
               }")
            ->language(self::lang());
    }

    protected function getColumns(): array
    {
        return [
            Column::make('id')->name('id')->data('DT_RowIndex')->title('#')->addClass('text-center small-td'),
            Column::make('title')->name('title')->data('title')->title(trans('admin.title'))->addClass('text-center medium-td'),
            Column::make('body')->name('body')->data('body')->title(trans('admin.body'))->addClass('text-center medium-td'),
           Column::make('created_at')->name('created_at')->data('created_at')->title(trans('admin.created_at'))->addClass('text-center medium-td'),
            Column::computed('attachments')->name('attachments')->data('attachments')->title(trans('admin.attachments'))->addClass('text-center large-td')
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->searchable(false),
            Column::computed('edit')->name('edit')->data('edit')->title(trans('admin.edit'))->addClass('text-center medium-td')
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->searchable(false),
            Column::computed('delete')->name('delete')->data('delete')->title(trans('admin.delete'))->addClass('text-center medium-td')
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->searchable(false),
            Column::computed('checkbox')->name('checkbox')->data('checkbox')->title('<input type="checkbox" class="check_all" onclick="check_all()"/>')
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->searchable(false)
                ->addClass('text-center small-td')
            ];
    }

    protected function filename(): string
    {
        return 'Posts_' . date('YmdHis');
    }
}
