@foreach($people as $person)
    <p>{{ $person->first_name }} {{ $person->last_name }} - Créé par {{ $person->creator->name }}</p>
@endforeach