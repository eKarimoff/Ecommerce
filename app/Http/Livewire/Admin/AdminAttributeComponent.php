<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\ProductAttribute;
class AdminAttributeComponent extends Component
{
    public function deleteAttribute($attribute_id)
    {
        $pattribute = ProductAttribute::find($attribute_id);
        $pattribute->delete();
        session()->flash('message','Attribute has been deleted successfully');
    }
    public function render()
    {
        $pattributes = ProductAttribute::paginate(10);
        return view('livewire.admin.admin-attribute-component',['pattributes'=>$pattributes])->layout('layouts.base');
    }
}
