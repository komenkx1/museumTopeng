<button class="btn tbn-sm btn-success"wire:click="triggerConfirm({{ $row->id }})"><i class="bi bi-check text-white"></i></button>
<button class="btn tbn-sm btn-danger" wire:click="triggerConfirmReject({{ $row->id }})"><i class="bi bi-x text-white"></i></button>