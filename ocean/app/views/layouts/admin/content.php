<?php
  //session_start();
?>
<body>
<div id="container">
<div class="input-container">
  <form method="post">
    <h2>Kontrola Użytkowników</h2><br>
    <button type="submit" name="getAllUsers">Wyświetl wszystkich użytkowników</button><br>
    <button type="submit" name="showOnlyUsers">Wyświetl wszystkich bez roli</button><br>
    <button type="submit" name="create">Stwórz użytkownika</button><br>
    <button type="submit" name="remove">Usuń użytkownika</button><br>
    <button type="submit" name="addRole">Nadaj rolę użytkownikowi</button><br><br>
    <h2>Kontrola Nauczycieli</h2><br>
    <button type="submit" name="showAllTeachers">Wyświetl wszystkich nauczycieli</button><br>
    <button type="submit" name="addRoleTeacher">Przypisz nauczyciela do przedmiotu</button><br><br>
    <h2>Kontrola Uczniów</h2><br>
    <button type="submit" name="showAllStudents">Wyświetl wszystkich uczniów</button><br>
    <button type="submit" name="showClassMembers">Wyświetl uczniów podanej klasy</button><br>
    <button type="submit" name="addRoleStudent">Przypisz ucznia do klasy</button><br>
    <button type="submit" name="showGrades">Pokaż oceny</button><br>
  </form>
</div>
</div>
</body>