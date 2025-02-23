<form method="POST" action="{{ route('people.store') }}">
    @csrf
    <input name="first_name" placeholder="Prénom" required>
    <input name="last_name" placeholder="Nom" required>
    <input name="birth_name" placeholder="Nom de naissance">
    <input name="middle_names" placeholder="Prénoms secondaires (séparés par des virgules)">
    <input name="date_of_birth" type="date">
    <button type="submit">Créer</button>
</form>