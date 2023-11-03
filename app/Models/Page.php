<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

/**
 * @property int|mixed published
 * @property int|mixed parent_id
 */
class Page extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $_parents = [];
    protected $_url = null;

    public function children()
    {
        return $this->hasMany(Page::class, 'parent_id')->orderBy('order');
    }

    public function getUrlAttribute() {
        if ($this->_url)
            return $this->_url;

        $path = [$this->alias];
        if (!count($this->_parents)) {
            $this->getParents();
        }
        foreach ($this->_parents as $parent) {
            $path[] = $parent->alias;
        }
        $path = implode('/', array_reverse($path));
        $this->_url = url($path);

        return $this->_url;
    }

    public static function getPages($id = null) {
        $pages = Cache::get('pages', []);
        if (!$pages) {
            $pages_arr = Page::all(['id', 'name', 'alias', 'published', 'parent_id']);
            foreach ($pages_arr as $item) {
                $pages[$item->id] = $item;
            }
            Cache::add('pages', $pages, 1);
        }
        if ($id) {
            return (isset($pages[$id])) ? $pages[$id] : null;
        } else {
            return $pages;
        }
    }

    public function getParents($with_self = false, $reverse = false): array {
        $p = $this;
        $parents = [];
        if ($with_self) $parents[] = $p;
        if (!count($this->_parents) && $this->parent_id > 1) {
            while ($p && $p->parent_id > 1) {
                $p = self::getPages($p->parent_id);
                $this->_parents[] = $p;
            }
        }
        $parents = array_merge($parents, $this->_parents);
        if ($reverse) {
            $parents = array_reverse($parents);
        }

        return $parents;
    }

    public function getChildren($id = 0): array
    {
        $res = [];
        if($id > 0) {
            $page = Page::find($id);
            if($page->children()->count()) {
                foreach ($page->children as $child) {
                    $has_children = (bool)$child->children()->count();
                    $res[] = [
                        'title' => $child->name,
                        'key' => $child->id,
                        'folder' => $has_children,
                        'href' => $child->url,
                        'children' => self::getChildren($child->id)
                    ];
                }
            }
        }
        return $res;
    }

    public function settingGroups(): HasMany {
        return $this->hasMany(SettingGroup::class, 'page_id')->orderBy('order');
    }
}
