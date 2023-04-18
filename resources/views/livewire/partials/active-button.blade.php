<div>
    <div class="form-check form-switch justify-center">
        <input wire:model="isActive" name="status" id="{{ $field . $model->id }}" class="form-check-input" type="checkbox">
        <label class="form-check-label" for="{{ $field . $model->id }}"></label>
        <div x-data="{ show: false }" x-show="show" x-transition:leave.duration.400ms x-init="@this.on('saved', () => {
            show = true;
            setTimeout(() => { show = false; }, 2000)
        })"
            style="display: none">
            👌
        </div>
    </div>



</div>
