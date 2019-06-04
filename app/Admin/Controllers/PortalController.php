<?php

namespace App\Admin\Controllers;

use App\Models\Portal;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class PortalController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
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
            ->header('Detail')
            ->description('description')
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
            ->header('Edit')
            ->description('description')
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
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Portal);

        $grid->id('Id');
        $grid->nama_portal('Nama portal');
        $grid->deskripsi('Deskripsi');
        $grid->gambar('Gambar')->image();
        // $grid->gambar('Gambar')->display(function() {
        //     return  '<img src="'.$this->gambar.'" width="100" height="auto">';
        // });
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');

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
        $show = new Show(Portal::findOrFail($id));

        $show->id('Id');
        $show->nama_portal('Nama portal');
        $show->deskripsi('Deskripsi');
        $show->gambar('Gambar');
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
        $form = new Form(new Portal);

        $form->text('nama_portal', 'Nama portal');
        $form->textarea('deskripsi', 'Deskripsi');
        $form->image('gambar', 'Gambar')->move('portals')->uniquename()->removable();

        return $form;
    }
}
