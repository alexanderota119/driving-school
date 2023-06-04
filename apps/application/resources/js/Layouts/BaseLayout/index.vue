<template>
    <Head>
        <title>Ed Driving</title>
    </Head>
    <div v-if="$page.props.flash.message" class="alert">
        {{ $page.props.flash.message }}
    </div>
    <slot />
</template>
<script lang="ts" setup>
import { Head } from '@inertiajs/inertia-vue3';
</script>
