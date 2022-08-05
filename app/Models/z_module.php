<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Kalnoy\Nestedset\NodeTrait;

/**
 * App\Models\z_module
 *
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string|null $tip
 * @property string $ismenu
 * @property string|null $icon
 * @property string|null $url
 * @property string|null $author
 * @property string|null $memo
 * @property int $_lft
 * @property int $_rgt
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Kalnoy\Nestedset\Collection|z_module[] $children
 * @property-read int|null $children_count
 * @property-read z_module|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Kalnoy\Nestedset\Collection|static[] all($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module ancestorsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module ancestorsOf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module applyNestedSetScope(?string $table = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module countErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module d()
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module defaultOrder(string $dir = 'asc')
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module descendantsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module descendantsOf($id, array $columns = [], $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module fixSubtree($root)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module fixTree($root = null)
 * @method static \Kalnoy\Nestedset\Collection|static[] get($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module getNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module getPlainNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module getTotalErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module hasChildren()
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module hasParent()
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module isBroken()
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module leaves(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module makeGap(int $cut, int $height)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module moveNode($key, $position)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module newModelQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module newQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module orWhereAncestorOf(bool $id, bool $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module orWhereDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module orWhereNodeBetween($values)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module orWhereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module query()
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module rebuildSubtree($root, array $data, $delete = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module rebuildTree(array $data, $delete = false, $root = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module reversed()
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module root(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module whereAncestorOf($id, $andSelf = false, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module whereAncestorOrSelf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module whereAuthor($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module whereCreatedAt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module whereDescendantOf($id, $boolean = 'and', $not = false, $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module whereDescendantOrSelf(string $id, string $boolean = 'and', string $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module whereIcon($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module whereId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module whereIsAfter($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module whereIsBefore($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module whereIsLeaf()
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module whereIsRoot()
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module whereIsmenu($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module whereLft($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module whereMemo($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module whereName($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module whereNodeBetween($values, $boolean = 'and', $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module whereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module whereParentId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module whereRgt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module whereTip($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module whereTitle($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module whereUpdatedAt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module whereUrl($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module withDepth(string $as = 'depth')
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_module withoutRoot()
 * @mixin \Eloquent
 */
class z_module extends Model
{
    //
    use HasFactory, NodeTrait;

    protected $fillable = [
        'name', 'title', 'tip', 'ismenu', 'icon', 'url','author', 'memo', 'syscfg', 'usercfg',
    ];

    protected $hidden = ['pivot', 'updated_at', 'created_at'];


    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }
}
