    <x-slot name="header">
        <h2 class="text-center">Laravel 9 Livewire CRUD Demo</h2>
    </x-slot>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard v3</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v3</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                    role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <input wire:model.debounce.350ms="search" class="my-4 inline-flex justify-center rounded-md border px-4 py-2 shadow-sm">

                <button wire:click="create()"
                    class="my-4 inline-flex justify-center rounded-md border border-transparent px-4 py-2 bg-red-600 text-base font-bold text-white shadow-sm hover:bg-red-700">
                    Create Student
                </button>

                <button wire:click="graph()"
                    class="my-4 inline-flex justify-center rounded-md border border-transparent px-4 py-2 bg-blue-600 text-base font-bold text-white shadow-sm hover:bg-blue-700">
                    View Graph
                </button>
                
                @if($isModalOpen)
                    @include('livewire.create')
                @endif
                
                @if($isGraphModalOpen)
                    @include('livewire.chart')
                @endif

                <table class="table-fixed w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 w-20">No.</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Mobile</th>
                            <th class="px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody wire:sortable="updateStudentOrder">
                        @foreach ($students as $student)
                        <tr wire:sortable.item="{{ $student->id }}" wire:key="student-{{ $student->id }}" wire:sortable.handle>
                            <td class="border px-4 py-2">{{ $student->id }}</td>
                            <td class="border px-4 py-2">{{ $student->name }}</td>
                            <td class="border px-4 py-2">{{ $student->email}}</td>
                            <td class="border px-4 py-2">{{ $student->mobile}}</td>
                            <td class="border px-4 py-2">
                                <button wire:click="edit({{ $student->id }})"
                                    class="flex px-4 py-2 bg-gray-500 text-gray-900 cursor-pointer">Edit</button>
                                <button wire:click="delete({{ $student->id }})"
                                    class="flex px-4 py-2 bg-red-100 text-gray-900 cursor-pointer">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if(count($students))
                    {{ $students->links() }}
                @endif
            

            </div>
        </div>
    </div>    
</div>

