<?php

namespace App\Admin\Controllers\Database;

use App\Models\BrowseLog;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class BrowseLogController extends Controller
{
    use HasResourceActions;

    protected $description = 'browse_log';

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('列表')
            ->description($this->description)
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('详情')
            ->description($this->description)
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('编辑')
            ->description($this->description)
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('创建')
            ->description($this->description)
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BrowseLog);

        $grid->id(BrowseLog::labels()['id']);
        $grid->ip_addr(BrowseLog::labels()['ip_addr']);
        $grid->request_url(BrowseLog::labels()['request_url']);
        $grid->city_name(BrowseLog::labels()['city_name']);
        $grid->created_at(BrowseLog::labels()['created_at']);
//        $grid->updated_at(BrowseLog::labels()['updated_at']);

        // 默认倒序
        $grid->model()->orderBy('id', 'desc');

        // 禁止新增
        $grid->disableCreateButton();

        // 禁止所有操作
        $grid->disableActions();

        // 禁止选择
        $grid->disableRowSelector();

        $grid->filter(function ($filter) {
            // 禁止默认的 id 筛选
            $filter->disableIdFilter();
            // ip 筛选
            $filter->like('ip_addr', BrowseLog::labels()['ip_addr']);
            // 请求 url 筛选
            $filter->like('request_url', BrowseLog::labels()['request_url']);
            // 城市筛选
            $filter->like('city_name', BrowseLog::labels()['city_name']);
            // 访问日期
            $filter->day('created_at', BrowseLog::labels()['created_at']);
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(BrowseLog::findOrFail($id));

        $show->id('Id');
        $show->ip_addr('Ip addr');
        $show->request_url('Request url');
        $show->city_name('City name');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new BrowseLog);

        $form->text('ip_addr', 'Ip addr');
        $form->text('request_url', 'Request url');
        $form->text('city_name', 'City name');

        return $form;
    }
}
