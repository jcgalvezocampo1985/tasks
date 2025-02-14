<?php

namespace App\Livewire\User;

use App\Models\Client;
use App\Models\Department;
use App\Models\Institution;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use App\Mail\CreateUserMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

#[Title('Usuarios')]
class UserComponent extends Component
{
    use WithPagination;

    /* #region Properties */
    public $totalRegistros = 0;
    public $search = '';
    public $cant = 5;
    public $id;
    public $name;
    public $email;
    public $perfil;
    public $password;
    public $full_name;
    public $short_name;
    public $description;
    public $institution_id;
    public $department_id;
    public $querySelectInstitution = [];
    public $querySelectDepartment = [];
    public $userHasTasks = 0;

    /* #endregion */

    /* #region public function mount() */
    public function mount()
    {
        $this->querySelectInstitution = Institution::all();
        $this->querySelectDepartment = collect();
    }
    /* #endregion */

    /* #region public function updatedInstitutionId($value) */
    public function updatedInstitutionId($value)
    {
        $this->querySelectDepartment = Department::where('institution_id', $value)->get();
    }
    /* #endregion */

    /* #region protected function rules() */
    protected function rules()
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email,'.$this->id,
            'perfil' => [
                'required',
                Rule::in(["Admin","Cliente","Técnico"]),
            ]
        ];

        if($this->perfil == 'Cliente')
            $rules = array_merge($rules, [
                'full_name' => 'required|max:255',
                'short_name' => 'required|max:255',
                'description' => 'max: 255',
                'institution_id' => 'required',
                'department_id' => 'required'
            ]);

        return $rules;
    }
    /* #endregion */

    /* #region protected function validationAttributes() */
    protected function validationAttributes()
    {
        $attributes = [
            'name' => 'Nombre',
            'email' => 'Email',
            'perfil' => 'Perfil'
        ];

        if($this->perfil == 'Cliente')
            $attributes = array_merge($attributes, [
                'full_name' => 'Nombre Completo',
                'short_name' => 'Nombre Corto',
                'description' => 'Descripción',
                'institution_id' => 'Institución',
                'department_id' => 'Departamento'
            ]);

        return $attributes;
    }
    /* #endregion */

    /* #region public function render() */
    public function render()
    {
        if($this->search != '')
            $this->resetPage();

        $this->totalRegistros = User::count();

        $querySelectUser = User::where('name','like','%'.$this->search.'%')
                                ->orWhere('email','like','%'.$this->search.'%')
                                ->orderBy('id', 'desc')
                                ->paginate($this->cant);

        return view('livewire.user.index-component',[
            'querySelectUser' => $querySelectUser
        ]);
    }
    /* #endregion */

    /* #region public function create() */
    public function create()
    {
        $this->clean();
        $this->id = 0;
        //Abrir modal
        $this->dispatch('open-modal', 'modalUser');
    }
    /* #endregion */

    /* #region public function store() */
    public function store()
    {
        $password = str::random(10);
        $queryStoreUser = User::create(array_merge($this->validate(), ['password' => Hash::make($password)]));

        if($queryStoreUser)
        {
            if($this->perfil == 'Cliente')
                Client::create([
                    'full_name' => $this->full_name,
                    'short_name' => $this->short_name,
                    'description' => $this->description,
                    'department_id' => $this->department_id,
                    'user_id' => $queryStoreUser->id
                ]);

            Mail::to($this->email)->send(new CreateUserMail([
                'name' => $this->name,
                'email' => $this->email,
                'password' => $password,
                'url' => url('/')
            ]));
        }
        //Cerrar modal
        $this->dispatch('close-modal', 'modalUser');
        //Mostrar mensaje
        $this->dispatch('msg', ['msg' => 'Usuario creado correctamente', 'type' => 'success']);
        //Reset de campos
        $this->clean();
    }
    /* #endregion */

    /* #region public function edit(User $user) */
    public function edit(User $user)
    {
        $this->clean();

        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->perfil = $user->perfil;

        if($user->clients->count() > 0){
            $this->full_name = $user->clients[0]->full_name;
            $this->short_name = $user->clients[0]->short_name;
            $this->description = $user->clients[0]->description;
            $this->department_id = $user->clients[0]->department_id;
            $this->institution_id = $user->clients[0]->department->institution_id;

            $this->querySelectDepartment = Department::where('institution_id', $this->institution_id)->get();
        }

        //Abrir modal
        $this->dispatch('open-modal', 'modalUser');
    }
    /* #endregion */

    /* #region public function update(User $user) */
    public function update(User $user)
    {
        $user->update($this->validate());

        if($this->perfil == 'Cliente'){
            if($user->clients->count() > 0)
            {
                $user->clients[0]->full_name = $this->full_name;
                $user->clients[0]->short_name = $this->short_name;
                $user->clients[0]->description = $this->description;
                $user->clients[0]->department_id = $this->department_id;
                $user->clients[0]->update();
            }
            else
            {
                Client::create([
                    'full_name' => $this->full_name,
                    'short_name' => $this->short_name,
                    'description' => $this->description,
                    'department_id' => $this->department_id,
                    'user_id' => $this->id
                ]);
            }
        }
        //Cerrar modal
        $this->dispatch('close-modal', 'modalUser');
        //Mostrar mensaje
        $this->dispatch('msg', ['msg' => 'Usuario modificado correctamente', 'type' => 'success']);
        //Reset de campos
        $this->clean();
    }
    /* #endregion */

    /* #region public function detroy($id) */
    #[On('destroyUser')]
    public function detroy($id)
    {
        $user = User::findOrFail($id);

        if($user->clients[0]->tasks->count() == 0)
        {
            $user->clients()->delete();
            $user->delete();
            $this->dispatch('msg', ['msg' => 'Usuario eliminado correctamente', 'type' => 'success']);
        }
        else
        {
            $this->dispatch('msg', ['msg' => 'El usuario no se puede eliminar debido a que tiene tareas relacionadas', 'type' => 'danger']);
        }
    }
    /* #endregion */

    /* #region public function disabled($id) */
    #[On('disabledUser')]
    public function disabled($id)
    {
        $user = User::findOrFail($id);
        $user->register_status = 'Disabled';
        $user->save();

        if($user->clients->count() > 0){
            $user->clients[0]->register_status = 'Disabled';
            $user->clients[0]->save();
        }

        $this->dispatch('msg', ['msg' => 'Usuario deshabilitado correctamente', 'type' => 'success']);
    }
    /* #endregion */

    /* #region public function enabled($id) */
    #[On('enabledUser')]
    public function enabled($id)
    {
        $user = User::findOrFail($id);
        $user->register_status = 'Enabled';
        $user->save();

        if($user->clients->count() > 0){
            $user->clients[0]->register_status = 'Enabled';
            $user->clients[0]->save();
        }

        $this->dispatch('msg', ['msg' => 'Usuario habilitado correctamente', 'type' => 'success']);
    }
    /* #endregion */

    /* #region public function clean() */
    public function clean()
    {
        //Reset de campos
        $this->reset(['id','name','email','perfil','full_name','short_name','description','department_id','institution_id']);
        //Reset mensajes validación
        $this->resetErrorBag();
    }
    /* #endregion */
}
