# PHP File Comparison Script

This PHP script compares two **lexicographically sorted** input files and generates two output files:
- `output1.txt` - contains strings found **only in the first input file**.
- `output2.txt` - contains strings found **only in the second input file**.

## Usage

1. Ensure input files (`input1.txt` and `input2.txt`) are **sorted**.
2. The script **automatically checks if files are sorted**. If they are not, an error will be displayed.
3. Run the script:
   ```sh
   php script.php
