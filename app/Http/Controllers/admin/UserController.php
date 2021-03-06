<?php

namespace Theater\Http\Controllers\admin;

use Theater\Entities\Award;
use Theater\Entities\City;
use Theater\Entities\Region;
use Validator;
use Illuminate\Http\Request;

use Theater\Entities\Organization;
use Theater\Http\Requests;
use Theater\Http\Controllers\Controller;
use Theater\Http\Services\Validation;
use Theater\Http\Services\UserManagement;

class UserController extends Controller
{

    public function index(){
        return view('back.choose');
    }

    public function generateExcel(Request $request, $type){
        shell_exec("cd " . $_SERVER['DOCUMENT_ROOT'] . "; cd ..; php artisan download:excel " . $type . " " . $request->get('email') . " > /dev/null &");
        return redirect()->back()->with(['Success' => 'El Excel está siendo generado, se enviará el link a su email.']);
    }

    public function searchUser(Request $request, $type){
        $search = $request->get('search');
        $awards = !$search
            ? $this->getUsers($type)
            : $this->getSearchUsers($type, $search);

        if($type == 1)
            return view('back.colonUsers', compact('awards'));
        return view('back.semanaUsers', compact('awards'));
    }

    public function colonUsers(){
        $awards = $this->getUsers(1);
        return view('back.colonUsers', compact('awards'));
    }

    public function semanaUsers(){
        $awards = $this->getUsers(2, auth()->user()->region_id);
        $isEditable = $awards[0]->isSelEdit;
        return view('back.semanaUsers', compact('awards', 'isEditable'));
    }
    
    public function semanaEditUser($id){
        $award = Award::with('organization')->find($id);
        $regions = Region::where('id', '<>', 1)->orderBy('name')->get();
        $cities = City::orderBy('name')->get();
        return view('back.semanaEditUser', compact('award', 'regions', 'cities'));
    }

    public function colonEditUser($id){
        $award = Award::with('organization')->find($id);
        $cities = City::orderBy('name')->get();
        return view('back.colonEditUser', compact('award', 'cities'));
    }

    public function semanaUpdate(Request $request, $id){
        $inputs = $request->all();
        $validate = Validator::make($inputs, Validation::getSemanaRules());

        if($validate->fails())
            return redirect()->back()->withErrors($validate)->withInput();

        $award = Award::find($id);
        UserManagement::updateSemana($award, $inputs);
        return redirect()->route('semanaUsers')->with(['Success' => 'La inscripción se ha actualizado satisfactoriamente.']);
    }

    public function colonUpdate(Request $request, $id){
        $inputs = $request->all();
        $validate = Validator::make($inputs, Validation::getColonRules());
        if($validate->fails())
            return redirect()->back()->withErrors($validate)->withInput();

        $award = Award::find($id);
        UserManagement::updateColon($award, $inputs);
        return redirect()->route('colonUsers')->with(['Success' => 'La inscripción se ha actualizado satisfactoriamente.']);;
    }

    private function getUsers($type, $region = null){
        return Award::whereHas('user', function($query){
            $query->where('state', 1);
        })->where('award_type_id', $type)
          ->whereHas('organization' , function($query) use($region){
              if($region > 1)
              $query->whereHas('city', function($query) use($region){
                  $query->where('region_id', $region);
              });
        })->with('organization')
          ->orderBy('isSelected', 'DESC')
          ->orderBy('isPreselected', 'DESC')
          ->paginate(20);
    }

    private function getSearchUsers($type, $search){
        return Award::where([
            ['award_type_id', $type],
            ['state', 1]
        ])->whereHas('user', function($q) use($search, $type){
            $q->where('users.email', 'like', '%' . $search . '%');
        })->orWhereHas('organization', function($q) use($search, $type){
            $q->where('organizations.name', 'like', '%' . $search . '%');
        })->with(['user', 'organization'])->paginate(20);
    }
}
