<button wire:click="select({{ $row->id }})" class="btn tbn-sm btn-secondary" ><i class="bi bi-pencil text-white"></i></button>
<button class="btn tbn-sm btn-danger" wire:click="triggerConfirm({{ $row->id }})"><i class="bi bi-trash text-white"></i></button>