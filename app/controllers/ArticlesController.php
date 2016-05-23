<?php

use huijimuhe\Repo\ArticleRepository,
    huijimuhe\Core\Listeners\CreatorListener,
    huijimuhe\Core\Listeners\UpdaterListener,
    huijimuhe\Core\Listeners\DeleterListener;

class ArticlesController extends BaseController implements CreatorListener, UpdaterListener, DeleterListener {

    protected $articleRepo;

    public function __construct(ArticleRepository $aRepo) {
        parent::__construct();
        $this->articleRepo = $aRepo;
    }

    public function getPages($page = 0) {
        $query = new Article();
        $query = $this->getList($query, $page); 
        return Response::json($query);
    }

    public function index() {
        $articles = $this->articleRepo->getAllPaginated(50);
        return View::make('articles.index', compact('articles'));
    }

    public function show($id) {
        $article = $this->articleRepo->requireById($id);
        return View::make('articles.show', compact('article'));
    }

    public function create() {
        return View::make('articles.create_edit');
    }

    public function edit($id) {
        $model = $this->articleRepo->requireById($id);
        return View::make('articles.create_edit', compact('model'));
    }

    public function store() {

        $text = $this->articleRepo->getDom(Input::get('text'));

        $data = [
            'title' => Input::get('title'),
            'text' => $text,
            'author' => '文章作者'];

        return $this->articleRepo->create($this, $data);
    }

    public function update($id) {

        $model = $this->articleRepo->requireById($id);

        $content = Input::get('text');
        $dom = new DOMDocument();
        $dom->loadHTML($content);
        $text = $this->getDom($dom->documentElement);

        $data = [
            'title' => Input::get('title'),
            'text' => $text,
            'author' => '文章作者'];
        return $this->repo->update($this, $model, $data);
    }

    public function destroy($id) {
        $model = $this->articleRepo->requireById($id);
        return $this->articleRepo->deleteModel($this, $model);
    }

    public function CreateError($errors) {
        Flash::error('出现错误' . $errors->first());
        return Redirect::back()->withInput();
    }

    public function Created($model) {
        Flash::success('操作成功');
        return Redirect::back()->withInput();
    }

    public function Deleted($model) {
        Flash::success('操作成功');
        return Redirect::back();
    }

    public function UpdateError($errors) {
        Flash::error('出现错误' . $errors->first());
        return Redirect::back()->withInput();
    }

    public function Updated($model) {
        Flash::success('操作成功');
        return Redirect::back()->withInput();
    }

}
