<template>
    <base-layout>
        <div>
            <div class="background"></div>
            <slot />
        </div>
    </base-layout>
</template>
<script lang="ts" setup>
//
</script>
<style lang="scss" scoped>
.background {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    width: 100vw;
    background: url('/img/login/login-background.jpg') no-repeat;
    background-size: 100vw 100vh;
    z-index: -1;
    filter: blur(3px) brightness(100%);
}
</style>
