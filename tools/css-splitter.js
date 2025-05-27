/**
 * CSS Splitter Utility
 * 
 * This script breaks down the large style.css file into smaller, modular files
 * based on section comments. It helps maintain better organization of styles.
 */

const fs = require('fs');
const path = require('path');

// Configuration
const SOURCE_FILE = path.join(__dirname, '../public/assets/css/style.css');
const OUTPUT_DIR = path.join(__dirname, '../public/assets/css/components');
const MAIN_OUTPUT_FILE = path.join(__dirname, '../public/assets/css/main.css');

// Ensure output directory exists
if (!fs.existsSync(OUTPUT_DIR)) {
    fs.mkdirSync(OUTPUT_DIR, { recursive: true });
}

// Read the source file
let cssContent = '';
try {
    cssContent = fs.readFileSync(SOURCE_FILE, 'utf8');
    console.log(`Successfully read ${SOURCE_FILE}`);
} catch (error) {
    console.error(`Error reading source file: ${error.message}`);
    process.exit(1);
}

// Extract CSS variables and base styles (these will go to main.css)
const variablesRegex = /:root\s*{[^}]*}/s;
const variablesMatch = cssContent.match(variablesRegex);
const variables = variablesMatch ? variablesMatch[0] : '';

// Remove variables from content to process
if (variables) {
    cssContent = cssContent.replace(variablesRegex, '');
}

// Split content by section comments
const sectionRegex = /\/\* =====\s*([^=]+)\s*===== \*\//g;
let match;
const sections = [];
let lastIndex = 0;

while ((match = sectionRegex.exec(cssContent)) !== null) {
    const title = match[1].trim();
    const startIndex = match.index;
    
    if (sections.length > 0) {
        sections[sections.length - 1].content = cssContent.substring(lastIndex, startIndex).trim();
    }
    
    sections.push({
        title,
        startIndex,
        content: ''
    });
    
    lastIndex = startIndex;
}

// Add the last section
if (sections.length > 0) {
    sections[sections.length - 1].content = cssContent.substring(lastIndex).trim();
}

// Create main.css with variables and imports
let mainCssContent = `/* Main CSS for Łowisko Lipuś - Generated File */\n\n`;
mainCssContent += `/* CSS Variables */\n${variables}\n\n`;
mainCssContent += `/* Basic styles */\n`;
mainCssContent += `* {\n  margin: 0;\n  padding: 0;\n  box-sizing: border-box;\n}\n\n`;
mainCssContent += `body {\n  font-family: 'Montserrat', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;\n  line-height: 1.8;\n  color: var(--text-color);\n  background-color: var(--background-color);\n  overflow-x: hidden;\n  font-weight: 400;\n}\n\n`;
mainCssContent += `/* Component imports */\n`;

// Process each section and save to separate files
sections.forEach((section, index) => {
    if (!section.title || !section.content) return;
    
    // Create a filename from the section title
    const filename = section.title
        .toLowerCase()
        .replace(/\s+/g, '-')
        .replace(/[^a-z0-9-]/g, '') + '.css';
    
    const outputPath = path.join(OUTPUT_DIR, filename);
    
    // Add import to main.css
    mainCssContent += `@import 'components/${filename}';\n`;
    
    // Save section to its own file
    try {
        fs.writeFileSync(outputPath, `/* ${section.title} styles */\n\n${section.content}`);
        console.log(`Created ${filename}`);
    } catch (error) {
        console.error(`Error writing ${filename}: ${error.message}`);
    }
});

// Save main.css
try {
    fs.writeFileSync(MAIN_OUTPUT_FILE, mainCssContent);
    console.log(`Created main.css with imports`);
} catch (error) {
    console.error(`Error writing main.css: ${error.message}`);
}

console.log('\nCSS splitting complete!');
console.log('Original file size:', (fs.statSync(SOURCE_FILE).size / 1024).toFixed(2), 'KB');
console.log('New main file size:', (fs.statSync(MAIN_OUTPUT_FILE).size / 1024).toFixed(2), 'KB');
console.log('\nTo use the new modular CSS:');
console.log('1. Replace <link rel="stylesheet" href="/assets/css/style.css"> with');
console.log('   <link rel="stylesheet" href="/assets/css/main.css">');
console.log('2. Test thoroughly to ensure all styles are working correctly');
console.log('3. Once confirmed working, you can optionally rename main.css to style.css'); 