<?php

namespace App\Admin\Controllers\Database;

use App\Models\FakerUser;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class FakerUserController extends Controller
{
    use HasResourceActions;

    protected $description = 'faker_user';

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
        $grid = new Grid(new FakerUser);

        $grid->id(FakerUser::labels()['id']);
        $grid->name(FakerUser::labels()['name']);
        $grid->email(FakerUser::labels()['email']);
        $grid->age(FakerUser::labels()['age'])->sortable();// 字段排序
        $grid->city(FakerUser::labels()['city']);
        $grid->created_at(FakerUser::labels()['created_at']);
        $grid->updated_at(FakerUser::labels()['updated_at']);

        // 默认倒序
        $grid->model()->orderBy('id', 'desc');

        $grid->filter(function ($filter) {
            // 禁止默认的 id 筛选
            $filter->disableIdFilter();
            // 姓名筛选
            $filter->like('name', FakerUser::labels()['name']);
            // 城市筛选
            $filter->like('city', FakerUser::labels()['city']);
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
        $show = new Show(FakerUser::findOrFail($id));

        $show->id('Id');
        $show->name('Name');
        $show->email('Email');
        $show->age('Age');
        $show->city('City');
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
        $form = new Form(new FakerUser);

        // FakerUser::labels() 是对应的显示标签

        $form->text('name', FakerUser::labels()['name']);
        $form->email('email', FakerUser::labels()['email']);
        $form->number('age', FakerUser::labels()['age']);
        $form->text('city', FakerUser::labels()['city']);

        return $form;
    }
}
