<template>
    <div class="game-board">
        <div
            v-if="websocketOpen"
            class="game-board__area"
        >
            <div
                v-for="(boardRow, rowIndex) in boardRows"
                :key="`board-row--${rowIndex}`"
                class="game-board__row"
            >
                <div
                    v-for="(boardCell, colIndex) in boardRow"
                    :key="`board-col--${rowIndex}-${colIndex}`"
                    class="game-board__cell"
                    :class="{ 'game-board__cell--filled': boardCell }"
                    @click="onCellClick(colIndex, rowIndex)"
                >
                    <component
                        v-if="boardCell"
                        :is="detectComponent(boardCell)"
                    />
                </div>
            </div>
        </div>

        <h3 v-else>
            No connection available
        </h3>

        <h1
            v-if="result"
            class="game-board__result"
        >
      <span>
        Game result: <strong>{{ result }}</strong>
      </span>

            <button
                class="site-button"
                @click="reloadGame"
            >
                Play again?
            </button>
        </h1>
    </div>
</template>

<script>
import UserCross from './UserCross';
import CompCircle from './CompCircle';

const START_COMMAND = 'StartGame';
const MOVE_COMMAND = 'Move';
const END_COMMAND = 'GameEnded';

export default {
    name: 'GameBoard',
    components: {
        UserCross,
        CompCircle
    },
    props: {
        gameConfig: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            webSocket: null,
            isGameOn: true,
            result: '',
            boardRows: [
                ['', '', ''],
                ['', '', ''],
                ['', '', '']
            ]
        };
    },
    computed: {
        websocketOpen() {
            return this.webSocket ? true : null;
        }
    },
    mounted() {
        this.startConnection();
    },
    methods: {
        startConnection () {
            console.log('starting connection');
            this.webSocket = new WebSocket(process.env.VUE_APP_WEB_SOCKET_URL);

            this.webSocket.onopen = () => {
                this.webSocket.send(
                    JSON.stringify({
                        command: START_COMMAND,
                        ...this.gameConfig,
                    })
                );
            };

            this.webSocket.onmessage = (event) => {
                this.handleBoardChanges(JSON.parse(event.data));
            }
        },
        detectComponent(cellValue) {
            if (cellValue === 'x') {
                return 'UserCross';
            }

            return 'CompCircle';
        },
        onCellClick(xPosition, yPosition) {
            if (!this.isGameOn) {
                return;
            }

            const moveData = {
                command: MOVE_COMMAND,
                x: xPosition,
                y: yPosition
            }

            console.log(moveData);

            this.webSocket.send(
                JSON.stringify(moveData)
            );
        },
        handleBoardChanges(data) {
            const { fields, command, playerResult } = data;

            if (fields) {
                this.boardRows = fields;
            }

            if (command && END_COMMAND === command && playerResult) {
                this.isGameOn = false;

                this.result = playerResult;
            }
        },
        reloadGame() {
            window.location.reload();
        }
    }
};
</script>

<style scoped lang="scss">
.game-board {
    display: flex;
    flex-direction: column;
}

.game-board__area {
    display: flex;
    flex-direction: column-reverse;
    width: 300px;
    height: 300px;
}

.game-board__row {
    display: flex;
    height: 100% * 1/3;
    border-top: 2px solid #abd8ff;

    &:last-child {
        border-top-width: 0;
    }
}

.game-board__cell {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100% * 1/3;
    height: 100%;
    border-right: 2px solid #abd8ff;
    cursor: pointer;
    text-align: center;

    &:last-child {
        border-right-width: 0;
    }
}

.game-board__cell--filled {
    pointer-events: none;
}

.game-board__result {
    margin-top: 16px;
    font-weight: 400;
    text-align: center;

    span {
        display: block;
    }
}
</style>
