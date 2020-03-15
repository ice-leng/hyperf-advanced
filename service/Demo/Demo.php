<?php

namespace Service\Demo;

use Common\Helper\ConstantHelper;
use Lengbin\Helper\YiiSoft\Arrays\ArrayHelper;
use Lengbin\Hyperf\YiiDb\ActiveRecord;
use Lengbin\Hyperf\YiiDb\Query;

class Demo extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%demo}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['is_delete'], 'default', 'value' => 0],
            [['id', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'name'       => '标题',
            'is_delete'  => '是否删除',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    /**
     *
     * @param array $params
     * @param bool  $isAll
     *
     * @return array
     * @throws \Lengbin\YiiDb\Exception\Exception
     * @throws \Lengbin\YiiDb\Exception\InvalidConfigException
     * @throws \Lengbin\YiiDb\Exception\NotSupportedException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \Throwable
     */
    public function getDemo(array $params = [], $isAll = false): array
    {
        $query = new Query();
        $query->from($this->tableName())->where([
            'is_delete' => ConstantHelper::NOT_DELETE,
        ]);

        if (ArrayHelper::isValidValue($params, 'name')) {
            $query->andWhere(['like', 'name', $params['name']]);
        }

        return $isAll ? $query->all() : $this->page($query);
    }

}
