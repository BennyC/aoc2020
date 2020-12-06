import { readFileSync } from 'fs';
import { join, dirname } from "path"
import { fileURLToPath } from "url";

const __dirname = dirname(fileURLToPath(import.meta.url));
const input = readFileSync(join(__dirname, "input.txt"), 'utf-8');
const inputs = input.split("\n").map(i => Number(i));

const descending = [...inputs].sort((a, b) => a - b)

for (let x = 0; x < descending.length - 2; x++) {
    let [y, z] = [x + 1, descending.length - 1];
    const a = descending[x];

    while (y < z) {
        const [b, c] = [descending[y], descending[z]];
        const total = a + b + c;
        if (total === 2020)  {
            console.log(a * b * c);
            break;
        }

        if (total < 2020) y++;
        if (total > 2020) z--;
    }
}
