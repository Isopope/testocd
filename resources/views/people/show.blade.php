<h1>{{ $person->first_name }} {{ $person->last_name }}</h1>
<p>Créé par: {{ $person->creator->name }}</p>
<h2>Parents</h2>
@foreach($person->parents as $parent)
    <p>{{ $parent->first_name }} {{ $parent->last_name }}</p>
@endforeach
<h2>Enfants</h2>
@foreach($person->children as $child)
    <p>{{ $child->first_name }} {{ $child->last_name }}</p>
@endforeach