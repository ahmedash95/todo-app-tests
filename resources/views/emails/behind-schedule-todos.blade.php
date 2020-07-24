@component('mail::message')
# Todos need your actions
@component('mail::table')
| Todo       | Created At  |
|:------------- | --------:|
@foreach($todos as $todo)
| {{ $todo->name }}      | {{ $todo->created_at->format('Y-m-d H:i') }}      |
@endforeach
@endcomponent
@component('mail::button', ['url' => route('todo.index')]) Take actions @endcomponent

@endcomponent
