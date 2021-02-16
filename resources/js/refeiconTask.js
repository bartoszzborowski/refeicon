(
    function (){
        const generateMatrixArray = (range) => {
            const matrixArray = new Array(range).fill(null).map(()=>new Array(range).fill(null));
            for (let i = 0; i < range; i++) {
                for (let j = 0; j < range; j++) {
                    matrixArray[i][j] = Math.floor(Math.random() * 10)
                }
            }

            return matrixArray
        }

        function updateAllAdjacent(input) {
            const output = input
            const checked = new Set();
            const getKey = (x, y) => `${x}_${y}`;

            const width = input[0].length;
            const height = input.length;
            const getAllAdjacent = (x, y, numToFind, matches = [], isVertical = false) => {
                if (x >= width || x < 0 || y >= height || y < 0) {
                    return matches;
                }
                const key = getKey(x, y);
                if (!checked.has(key) && input[y][x] === numToFind) {
                    checked.add(key);
                    matches.push({ x, y });
                    if(!isVertical) {
                        getAllAdjacent(x + 1, y, numToFind, matches, isVertical);
                        getAllAdjacent(x - 1, y, numToFind, matches, isVertical);
                    } else {
                        getAllAdjacent(x, y + 1, numToFind, matches, isVertical);
                        getAllAdjacent(x, y - 1, numToFind, matches, isVertical);
                    }
                }
                return matches;
            };

            [true, false].forEach((isVertical) => {
                output.forEach((innerRowArr, y) => {
                    innerRowArr.forEach((num, x) => {
                        const adjacent = getAllAdjacent(x, y, num, [], isVertical);

                        if (adjacent.length <= 2) {
                            return;
                        }

                        adjacent.forEach(({ x, y }) => {
                            output[y][x] = {value: num, color: true}
                        });
                    });
                });
                checked.clear()
            });

            return output;
        }

        const drawMatrixArray = (matrixArray) => {
            const table = document.getElementById('matrixTable')

            for (let i = 0; i < matrixArray.length; i++) {
                let row = document.createElement("tr")
                for (let j = 0; j < matrixArray[i].length; j++) {
                    const item = document.createElement('td')
                    const element = matrixArray[i][j];

                    if(typeof element === 'object' && element !== null) {
                        item.className = 'color'
                        item.append(element.value)
                        row.append(item)
                    } else {
                        item.append(element)
                        row.append(item)
                    }
                }

                table.append(row)
            }
        }

        const matrixArray = generateMatrixArray(20)
        const result = updateAllAdjacent(matrixArray)
        drawMatrixArray(result)
    }
)();
