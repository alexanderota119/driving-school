<template>
    <div class="mt-5">
        <div class="p-3">
            <div class="row" style="gap: 20px">
                <div
                    v-for="(item, index) in list"
                    :key="`${name}.${index}`"
                    class="col-grow"
                >
                    <StudentTileItem :item="item" />
                </div>
            </div>
        </div>
    </div>
</template>
<script lang="ts" setup>
import StudentTileItem from './StudentTileItem';

interface Props {
    name: string;
    list: any[];
}

withDefaults(defineProps<Props>(), {
    name: 'StudentList',
});
</script>
