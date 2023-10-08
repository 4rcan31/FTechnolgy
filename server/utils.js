function findKeyByValue(map, valueToFind) {
    for (const [key, value] of map.entries()) {
      if (value === valueToFind) {
        return key; 
      }
    }
    return null;
}


module.exports = {
    findKeyByValue
}