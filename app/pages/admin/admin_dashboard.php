<!DOCTYPE html>
<html lang="pt-BR">
<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Admin - Dashboard</title>

   <!-- CSS -->
   <link rel="stylesheet" type="text/css" href="../../../src/css/reset.css" />
   <link rel="stylesheet" type="text/css" href="../../../src/css/pages/admin/admin_dashboard-styles.css" />
</head>
<body>
</body>
   <header>
      <nav>
         <div class="header-controller">
            <button class="btn-back"></button>
            <h2>olá <span class="userName">Fulano</span></h2>
         </div>
         <ul>
            <li data-current="true"><a href="#">Receitas</a></li>
            <li data-current="false"><a href="#">Categorias</a></li>
            <li data-current="false"><a href="#">Vídeos</a></li>
            <li data-current="false"><a href="#">Ingredientes</a></li>
         </ul>
      </nav>
   </header>
   <nav>
      <div>
         <input type="text" name="search" id="txtDashboardSearch">
      </div>
      <div>
         <select name="filter-categories" id="categories">
            <option value="#" selected disabled>Filtrar</option>
            <option value="most_recent">Mais Recente</option>
            <option value="older">Mais Antigo</option>
         </select>
      </div>
   </nav>
   <main>
      <div class="result-display">

      </div>
   </main>
</html>