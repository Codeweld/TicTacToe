<template>
  <div class="welcome-screen">
    <h1 class="welcome-screen__title">
      Tic Tac Toe
    </h1>

    <div class="welcome-screen__controls">
      <div class="welcome-screen__control">
        <label for="symbol-select">
          Select your symbol
        </label>
        
        <select
          v-model="gameConfig.symbol"
          id="symbol-select"
        >
          <option
            v-for="availableSymbol in availableSymbols"
            :key="`symbol-${availableSymbol}`"
          >
            {{ availableSymbol}}
          </option>
        </select>
      </div>

      <div class="welcome-screen__control">
        <label for="mode-select">
          Select play mode
        </label>
        
        <select
          v-model="gameConfig.mode"
          id="mode-select"
        >
          <option
            v-for="availableGameMode in availableGameModes"
            :key="`symbol-${availableGameMode.key}`"
            :value="availableGameMode.key"
            selected
          >
            {{ availableGameMode.name }}
          </option>
        </select>
      </div>

      <button
        class="site-button"
        @click="onModeSelect"
      >
        Play
      </button>
    </div>
  </div>  
</template>

<script>
import { EASY_MODE } from '../config/gameModes';
import { X_SYMBOL, O_SYMBOL } from '../config/playerSymbols';
import { TABLE_SIZE } from '../config/tableSize';

export default {
  name: 'WelcomeScreen',
  data() {
    return {
      easyModeKey: EASY_MODE,
      gameConfig: {
        symbol: X_SYMBOL,
        mode: EASY_MODE.key,
        tableSize: TABLE_SIZE
      },
      availableSymbols: {
        X_SYMBOL,
        O_SYMBOL,
      },
      availableGameModes: [
        EASY_MODE
      ],
      gameModeTranslations: {}
    };
  },
  methods: {
    onModeSelect() {
      this.$emit('mode-selected', this.gameConfig);
    }
  }
};
</script>

<style scoped lang="scss">
  .welcome-screen {
    width: 300px;
    padding: 20px;
    border-radius: 8px;
    background-color: #abd8ff;
    text-align: center;
  }

  .welcome-screen__controls {
    display: flex;
    flex-direction: column;
  }

  .welcome-screen__control {
    display: flex;
    margin-bottom: 10px;

    select {
      margin-left: auto;
    }
  }
</style>
