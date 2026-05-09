<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Alpine Markdown Viewer</title>
  <!-- Tailwind CSS & Typography Plugin -->
  <script src="https://tailwindcss.com"></script>
  <!-- Alpine.js -->
  <script defer src="https://jsdelivr.net"></script>
  <!-- Marked.js (Markdown Parser) -->
  <script src="https://jsdelivr.net"></script>
</head>
<body class="bg-gray-100 p-10">

  <!-- Markdown Block -->
  <div x-data="{ 
          content: 'Loading...', 
          async init() {
              try {
                  // Replace 'your-file.md' with your actual file path
                  let response = await fetch('/docs/SharedInfra.md');
                  let text = await response.text();
                  this.content = marked.parse(text);
              } catch (e) {
                  this.content = 'Failed to load content.';
              }
          } 
       }" 
       class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
    
    <!-- The 'prose' class from Tailwind Typography styles the rendered HTML -->
    <article class="prose lg:prose-xl" x-html="content"></article>

  </div>

</body>
</html>
