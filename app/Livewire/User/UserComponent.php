<?php

namespace App\Livewire\User;

use App\Models\Institution;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

use App\Models\User;

#[Title('Usuarios')]
class UserComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $totalRegistros = 0;
    public $search = '';
    public $cant = 5;
    public $id;
    public $name;
    public $email;
    public $perfil;
    public $password;

    /* #region public function mount() */
    public function mount()
    {

    }
    /* #endregion */

    /* #region protected function rules() */
    protected function rules()
    {
        return [
            'name' => 'required|max:255|unique:users,id,'.$this->id,
            'email' => 'required|max:255|unique:users,email,'.$this->id,
            'perfil' => 'required|in(["Admin","Cliente","Técnico"])',
            'password' => 'required'
        ];
    }
    /* #endregion */

    /* #region protected function validationAttributes() */
    protected function validationAttributes()
    {
        return [
            'name' => 'Nombre',
            'email' => 'Email',
            'perfil' => 'Perfil',
            'passsword' => 'Password'
        ];
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

        return view('livewire.user.user-component',[
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
        User::create($this->validate());

        //Cerrar modal
        $this->dispatch('close-modal', 'modalUser');
        //Mostrar mensaje
        $this->dispatch('msg', 'Usuario creado correctamente');
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
        $this->password = $user->password;

        //Abrir modal
        $this->dispatch('open-modal', 'modalUser');
    }
    /* #endregion */

    /* #region public function update(User $user) */
    public function update(User $user)
    {
        $user->update($this->validate());

        //Cerrar modal
        $this->dispatch('close-modal', 'modalUser');
        //Mostrar mensaje
        $this->dispatch('msg', 'Usuario modificado correctamente');
        //Reset de campos
        $this->clean();
    }
    /* #endregion */

    /* #region public function detroy($id) */
    #[On('destroyUser')]
    public function detroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        $this->dispatch('msg', 'Usuario eliminado correctamente');
    }
    /* #endregion */

    /* #region public function disabled($id) */
    #[On('disabledUser')]
    public function disabled($id)
    {
        $user = User::findOrFail($id);
        $user->register_status = 'Disabled';
        $user->save();

        $this->dispatch('msg', 'Usuario deshabilitado correctamente');
    }
    /* #endregion */
    
    /* #region public function enabled($id) */
    #[On('enabledUser')]
    public function enabled($id)
    {
        $user = User::findOrFail($id);
        $user->register_status = 'Enabled';
        $user->save();

        $this->dispatch('msg', 'Usuario habilitado correctamente');
    }
    /* #endregion */

    /* #region public function clean() */
    public function clean()
    {
        //Reset de campos
        $this->reset(['id','name','email','perfil','password']);
        //Reset mensajes validación
        $this->resetErrorBag();
    }
    /* #endregion */

    #[On('getPerfil')]
    public function getPerfil()
    {
        dd($this->perfil);
    }
}
