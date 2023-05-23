<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Student;
use Livewire\withPagination;

class CrudStudent extends Component
{
    use withPagination;
    public $name, $email, $mobile, $student_id;


    public $isModalOpen = 0;
    public $isGraphModalOpen = 0;

    public $search;
    
    public function render()
    {
        return view('livewire.crud-student', [
            'students' => Student::search(trim($this->search))->orderBy('order_position', 'asc')->paginate(10),
        ]);
    }


    public function graph()
    {
        $this->openGraphModalPopover();
    }


    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }
    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }
    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }


    
    public function openGraphModalPopover()
    {
        $this->isGraphModalOpen = true;
    }
    
    public function closeGraphModalPopover()
    {
        $this->isGraphModalOpen = false;
    }



    private function resetCreateForm(){
        $this->name = '';
        $this->email = '';
        $this->mobile = '';
    }
    
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
        ]);
    
        Student::updateOrCreate(['id' => $this->student_id], [
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
        ]);
        session()->flash('message', $this->student_id ? 'Student updated.' : 'Student created.');
        $this->closeModalPopover();
        $this->resetCreateForm();
    }
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $this->student_id = $id;
        $this->name = $student->name;
        $this->email = $student->email;
        $this->mobile = $student->mobile;
    
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        Student::find($id)->delete();
        session()->flash('message', 'Student deleted.');
    }


    public function updateStudentOrder($items) 
    {
        foreach($items as $item)
        {
            Student::find($item['value'])->update(['order_position' => $item['order']]);
        }
    }


}
