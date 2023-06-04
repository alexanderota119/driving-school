<template>
    <div v-if="title" class="page-header flex flex-md-row" style="gap: 15px">
        <h1>
            {{ title }}
            <small v-if="subTitle" v-text="subTitle"></small>
        </h1>
        <div v-if="false">
            <nav aria-label="breadcrumb mt-3" style="margin-top: 0.75rem">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>

                    <li
                        v-for="breadcrumb in breadcrumbs"
                        :class="{ active: breadcrumb.active }"
                        class="breadcrumb-item"
                    >
                        <component
                            :is="breadcrumb.href ? 'a' : 'span'"
                            :href="breadcrumb.href"
                            v-text="breadcrumb.title"
                        />
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</template>
<script lang="ts" setup>
import { Breadcrumb } from '@/utils/types/navs';

interface Props {
    title?: string;
    subTitle?: string;
    breadcrumbs?: Breadcrumb;
}

defineProps<Props>();
</script>
