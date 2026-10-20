@props(['status'])

<span class="badge badge-pill bg-{{ $status->color() }} text-{{ $status->color() }}-fg">{{ $status->label() }}</span>
