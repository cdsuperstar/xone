<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

/**
 * App\Models\z_unit
 *
 * @property int $id
 * @property string $title
 * @property string|null $brief
 * @property int $_lft
 * @property int $_rgt
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Kalnoy\Nestedset\Collection|z_unit[] $children
 * @property-read int|null $children_count
 * @property-read z_unit|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Kalnoy\Nestedset\Collection|static[] all($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit ancestorsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit ancestorsOf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit applyNestedSetScope(?string $table = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit countErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit d()
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit defaultOrder(string $dir = 'asc')
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit descendantsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit descendantsOf($id, array $columns = [], $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit fixSubtree($root)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit fixTree($root = null)
 * @method static \Kalnoy\Nestedset\Collection|static[] get($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit getNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit getPlainNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit getTotalErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit hasChildren()
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit hasParent()
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit isBroken()
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit leaves(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit makeGap(int $cut, int $height)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit moveNode($key, $position)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit newModelQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit newQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit orWhereAncestorOf(bool $id, bool $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit orWhereDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit orWhereNodeBetween($values)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit orWhereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit query()
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit rebuildSubtree($root, array $data, $delete = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit rebuildTree(array $data, $delete = false, $root = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit reversed()
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit root(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit whereAncestorOf($id, $andSelf = false, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit whereAncestorOrSelf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit whereBrief($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit whereCreatedAt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit whereDescendantOf($id, $boolean = 'and', $not = false, $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit whereDescendantOrSelf(string $id, string $boolean = 'and', string $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit whereId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit whereIsAfter($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit whereIsBefore($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit whereIsLeaf()
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit whereIsRoot()
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit whereLft($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit whereNodeBetween($values, $boolean = 'and', $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit whereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit whereParentId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit whereRgt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit whereTitle($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit whereUpdatedAt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit withDepth(string $as = 'depth')
 * @method static \Kalnoy\Nestedset\QueryBuilder|z_unit withoutRoot()
 * @mixin \Eloquent
 */
class z_unit extends Model
{
    use HasFactory,NodeTrait;
    //
    protected $fillable = [
        'title', 'brief',
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
