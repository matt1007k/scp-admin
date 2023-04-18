<div>
  <div x-data="{
      open: @entangle('showDropdown'),
      search: @entangle('search'),
      selected: @entangle('selected'),
      highlightedIndex: 0,
      highlightPrevious() {
        if (this.highlightedIndex > 0) {
          this.highlightedIndex = this.highlightedIndex - 1;
          this.scrollIntoView();
        }
      },
      highlightNext() {
        if (this.highlightedIndex < this.$refs.results.children.length - 1) {
          this.highlightedIndex = this.highlightedIndex + 1;
          this.scrollIntoView();
        }
      },
      scrollIntoView() {
        this.$refs.results.children[this.highlightedIndex].scrollIntoView({
          block: 'nearest',
          behavior: 'smooth'
        });
      },
      updateSelected(id, name) {
        this.selected = id;
        this.search = name;
        this.open = false;
        this.highlightedIndex = 0;
      },
  }">
    <div x-on:value-selected="updateSelected($event.detail.id, $event.detail.name)">
      <span>
        <div>
          <input wire:model.debounce.300ms="search" x-on:keydown.arrow-down.stop.prevent="highlightNext()" x-on:keydown.arrow-up.stop.prevent="highlightPrevious()" x-on:keydown.enter.stop.prevent="$dispatch('value-selected', {
            id: $refs.results.children[highlightedIndex].getAttribute('data-result-id'),
            name: $refs.results.children[highlightedIndex].getAttribute('data-result-name')
          })" class="form-control h-10 px-3" />
        </div>
      </span>

      <div x-show="open" x-on:click.away="open = false">
        <ul x-ref="results" class="shadow-lg rounded-sm box absolute z-50 min-w-[300px]" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-y-90" x-transition:enter-end="opacity-100 transform scale-y-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 transform scale-y-100" x-transition:leave-end="opacity-0 transform scale-y-90">
          @forelse($results as $index => $result)
          <li wire:key="{{ $index }}" x-on:click.stop="$dispatch('value-selected', {
                id: {{ $result->id }},
                name: '{{ $result->name }}'
              })" :class="{
                'bg-gray-200 dark:bg-slate-800': {{ $index }} === highlightedIndex,
                'bg-black dark:text-white': {{ $index }} === highlightedIndex
              }" data-result-id="{{ $result->id }}" data-result-name="{{ $result->name }}" class="py-3 px-4 hover:bg-gray-100 dark:hover:bg-slate-800 cursor-pointer">
            <span>
              {{ $result->name }}
            </span>
          </li>
          @empty
          <li class="py-3 px-4">Sin resultados encontrados</li>
          @endforelse
        </ul>
      </div>
    </div>
  </div>
</div>
