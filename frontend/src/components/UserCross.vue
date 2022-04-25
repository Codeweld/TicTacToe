<template>
  <div class="user-cross" />
</template>

<script>
export default {
  name: 'UserCross'
};
</script>

<style scoped lang="scss">
  .user-cross {
    position: relative;
    width: 60px;
    height: 60px;

    &:before,
    &:after {
      content: '';
      position: absolute;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 3px;
      background-color: #00d58c;
      margin: auto;
      transform-origin: center;
    }

    &:before {
      transform: rotateZ(45deg);
    }

    &:after {
      transform: rotateZ(-45deg);
    }
  }
</style>