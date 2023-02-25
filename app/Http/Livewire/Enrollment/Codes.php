<?php

namespace App\Http\Livewire\Enrollment;

use App\Models\EnrollmentCode;
use Carbon\Carbon;
use Livewire\Component;
use WireUi\Traits\Actions;

class Codes extends Component
{
    use Actions;

    public $created_code;
    public $codes;
    public $createCodeModal;

    public function generateCode() {
        $code = [
            'parish_id' => session('parish_id'),
            'community_id' => session('community_id'),
            'code' => random_int(10000, 99999),
            'expires_at' => Carbon::now()->addHours(2)->format('Y-m-d H:i:s'),
        ];
        try {
            EnrollmentCode::create($code);
            $this->created_code = $code;
        } catch (\Throwable $th) {
            $this->dialog()->error($description = 'Ocorreu um erro ao gerar código.');
            dd($th);
        }
    }

    public function openCreateCodeModal()
    {
        $this->createCodeModal = true;
    }

    public function closeCreateCodeModal()
    {
        $this->createCodeModal = false;
    }

    public function render()
    {
        $this->codes = EnrollmentCode::whereYear('created_at', date('Y'))->withCount('enrollments')->latest()->get();
        return view('livewire.enrollment.codes');
    }
}
