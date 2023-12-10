<?php

namespace Adminlte3\Models;

use App\Traits\HasH1;
use App\Traits\HasImage;
use App\Traits\HasSeo;
use App\Traits\OgGenerate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

/**
 * @property int|mixed published
 * @property int|mixed parent_id
 */
class Page extends Model
{
    use HasH1, HasImage, HasSeo, OgGenerate;

    const UPLOAD_URL = '/uploads/pages/';

    public static array $thumbs = [
        1 => '100x100', //admin
        2 => '180x180', //og_image
    ];

    private bool $_disableEventUpdateSlug = false;
    private bool $_disableEventUpdatePublished = false;

    protected $guarded = ['id'];
    protected array $_parents = [];
    protected string $_url = '';

    public static function boot() {
        parent::boot();

        self::saved(function (self $category){
            if($category->isDirty('alias') || $category->isDirty('parent_id')){
                if (!$category->_disableEventUpdateSlug){
                    self::updateUrlRecurse($category);
                }
            }
            if($category->isDirty('published') && $category->published == 0){
                if (!$category->_disableEventUpdatePublished){
                    self::updateDisablePublishedRecurse($category);
                }
            }
        });
    }

    //обновить slug страницы
    public static function updateUrlRecurse(self $page) {
        $parents = $page->getParents(true, true);
        $slug_arr = [];
        foreach ($parents as $parent){
            $slug_arr[] = $parent->alias;
        }
        //чтобы событие на обновление не сработало
        $page->_disableEventUpdateSlug = true;
        $page->update(['slug' => implode( '/', $slug_arr)]);
        foreach ($page->children()->get() as $child){
            self::updateUrlRecurse($child);
        }
    }

    public static function updateDisablePublishedRecurse(self $page) {
        //чтобы событие на обновление не сработало
        $page->_disableEventUpdatePublished = true;
        $page->update(['published' => 0]);
        foreach ($page->children()->get() as $child){
            self::updateUrlRecurse($child);
        }
    }

    public function getBread(): array {
        $bread = [];

        foreach ($this->getParents(true) as $p) {
            $bread[] = [
                'url'  => $p->url,
                'name' => $p->name
            ];
        }

        return array_reverse($bread);
    }

    public static function getByPath($path, $id = 1) {
        $parent_id = $id;
        $page = null;

        /* проверка по пути */
        foreach ($path as $alias) {
            $page = Page::whereAlias($alias)
                ->whereParentId($parent_id)
                ->public()
                ->get(['id', 'alias', 'parent_id'])
                ->first();
            if ($page === null) {
                return null;
            }
            $parent_id = $page->id;
        }

        if ($page && $page->id > 0) {
            return Page::find($page->id);
        } else {
            return null;
        }
    }

    public function children(): HasMany
    {
        return $this->hasMany(Page::class, 'parent_id')->orderBy('order');
    }

    public function public_children(): HasMany {
        return $this->children()
            ->where('published', 1)
            ->orderBy('order');
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

    public function scopePublic($query) {
        return $query->where('published', 1);
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
