<template>
  <div
    id="app"
    class="site-hld"
  >
    <WelcomeScreen
      v-if="!gameConfig"
      @mode-selected="gameBegin"
    />

    <GameBoard
      v-else
      :game-config="gameConfig"
    />
  </div>
</template>

<script>
import WelcomeScreen from './components/WelcomeScreen';
import GameBoard from './components/GameBoard';

export default {
  name: 'TicTacToe',
  components: {
    WelcomeScreen,
    GameBoard
  },
  data() {
    return {
      gameConfig: null
    };
  },
  methods: {
    gameBegin(gameConfig) {
      this.gameConfig = gameConfig;
    }
  }
};
</script>

<style lang="scss">
  body {
    margin: 0;
    box-sizing: border-box;

    * {
      box-sizing: border-box;
    }
  }

  .site-hld {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
  }

  .site-button {
    margin: 0 0 16px;
    padding: 17px 46px 15px;
    outline: none;
    border-width: 0;
    border-radius: 4px;
    background-color: #0075d9;
    box-shadow: 0 3px 6px 0 rgba(0, 0, 0, 0.08);
    cursor: pointer;
    color: #fff;
    font-size: 16px;
    transition: background-color 0.3s ease;

    &:last-child {
      margin-bottom: 0;
    }

    &:hover {
      background-color: #005aba;
    }
  }
</style>
