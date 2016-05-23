<?php

namespace huijimuhe\Repo;

use Article,
    DOMDocument,
    huijimuhe\Core\Listeners\CreatorListener,
    huijimuhe\Core\Listeners\UpdaterListener,
    huijimuhe\Core\Listeners\DeleterListener,
    huijimuhe\Core\Exceptions\EntityNotFoundException;

class ArticleRepository extends \huijimuhe\Core\Repo\EloquentRepository {

    public function __construct(Article $model) {
        $this->model = $model;
    }

    public function getDom($text) {

        $dom = new DOMDocument();
        $dom->loadHTML($text);
        $node = $dom->documentElement;
        $tempArray = false;

        //遍历所有节点
        $childs = $node->getElementsByTagName('p');
        foreach ($childs as $child) {

            //文字
            if ($child->nodeValue) {
                $tempArray[] = ['object' => $child->nodeValue, 'type' => 2];
            }

            //图片
            $imgs = $child->getElementsByTagName('img');
            if ($imgs) {
                foreach ($imgs as $img) {
                    $tempArray[] = ['object' => $img->attributes->getNamedItem('src')->nodeValue, 'type' => 3];
                }
            }
        }
        return json_encode($tempArray);
    }

    public function create(CreatorListener $observer, $data, $validator = null) {
        //验证
        if ($validator && $validator->fails()) {
            return $observer->CreateError($validator->messages());
        }
        //建MODEL
        $model = $this->getNew($data);
        //存MODEL
        if (!$this->save($model)) {
            return $observer->CreateError($model->getErrors());
        }

        return $observer->Created($model);
    }

    public function update(UpdaterListener $observer, $model, $data, $validator = null) {
        // check the passed in validator
        if ($validator && $validator->fails()) {
            return $observer->CreateError($validator->messages());
        }
        //导入数据
        $model->fill($data);
        // check the model validation
        if (!$this->save($model)) {
            return $observer->UpdateError($model->getErrors());
        }
        return $observer->Updated($model);
    }

    public function deleteModel(DeleterListener $observer, $model) {
        $this->delete($model);
        return $observer->Deleted($model);
    }

}
