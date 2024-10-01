                
                <?php if (!isset($noFoot) || $noFoot !== true) { ?>
                <div id="iib-foot" style="text-align:center;font-size:32pt;padding-top:20pt;padding-bottom:30pt;"><span class="immer-in-font-uc">II</span><span class="bewegung-font-uc">B</span>
                <!--<br/><div style="font-size:12pt;font-family: 'Francois+One', sans-serif;">Revisit your travel memories</div>--></div>
                <?php } ?>
                
        </div>



    </div>


</body>

<?php
    /* if ( $settings["app-language"] != "" || $settings["app-language"] != "en" ) {
?>

<script>

fetch('lang/<?php echo $settings["app-language"]; ?>.yml')
  .then(response => response.text())
  .then(ymlText => {
    // Simple YAML parser for key-value pairs and basic nesting
    const parseSimpleYAML = (yamlText) => {
  const result = {};
  const lines = yamlText.split('\n');
  let currentSection = null;

  lines.forEach(line => {
    const trimmedLine = line.trim();

    if (!trimmedLine || trimmedLine.startsWith('#')) {
      // Skip empty lines or comments
      return;
    }

    // Use regex to handle keys in quotes (single or double)
    const match = trimmedLine.match(/^['"]?(.*?)['"]?\s*:\s*['"]?(.*?)['"]?$/);

    if (match) {
      const key = match[1].trim();
      const value = match[2].trim();

      if (!value) {
        // This is a section header (e.g., "menu:")
        currentSection = key;
        result[currentSection] = {};
      } else if (currentSection) {
        // This is a nested key-value pair (e.g., "overview: Översikt")
        result[currentSection][key] = value;
      } else {
        // This is a top-level key-value pair (e.g., "search-placeholder: Vad söker du?")
        result[key] = value;
      }
    }
  });

  return result;
};

    const ymlObject = parseSimpleYAML(ymlText);

    // Function to recursively update text content based on "lang-" prefixed IDs
    const applyTranslations = (obj, prefix = 'lang-') => {
      for (const key in obj) {
        if (typeof obj[key] === 'object') {
          // Recursively handle nested objects
          applyTranslations(obj[key], `${prefix}${key}-`);
        } else {
          // Handle the translation for elements with id="lang-..."
          const elementId = `${prefix}${key}`;
          const element = document.getElementById(elementId);
          if (element) {
            if (element.tagName.toLowerCase() === 'input') {
              // Handle placeholders for input elements
              element.placeholder = obj[key];
            } else {
              // Update text content for other elements
              element.innerHTML = obj[key];
            }
          }
        }
      }
    };

    // Apply translations to all elements with "lang-" prefix
    applyTranslations(ymlObject);
  })
  .catch(error => console.error('Error fetching or processing YAML:', error));


</script>

<?php
    }*/
?>

</html>