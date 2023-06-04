<template>
    <div id="input-group-1" class="q-ma-md">
        <q-card no-body>
            <q-card-section vertical>
                <div class="mt-2">TODO :: new note entry</div>
                <div
                    v-for="(note, index) in fieldValue"
                    :active="note.id"
                    title="Notes"
                >
                    <div class="q-pa-sm">{{ note.text }}</div>
                    <q-separator v-if="index < (fieldValue?.length || 1) - 1" />
                </div>
            </q-card-section>
        </q-card>
    </div>
</template>
<script lang="ts" setup>
import { ModelIdType } from '@/types/form';
import { formStateUpdate, getError } from '@/utils';
import { EdDrivingComputedRef } from '@/utils/types/form';
import { inject, withDefaults } from 'vue';

interface Props {
    name?: string;
    description?: string;
    label?: string;
}

const props = withDefaults(defineProps<Props>(), {
    name: 'notes',
    label: 'Notes',
});

const testNotes = [
    {
        id: 1,
        text: 'welcome 1',
    },
    {
        id: 2,
        text: 'welcome 2',
    },
];

const fieldValue = inject<EdDrivingComputedRef<ModelIdType>>(formStateUpdate)(
    props.name,
    testNotes,
) as unknown as App.Models.Note;
const error = (inject(getError) as EdDrivingComputedRef)(props.name);
</script>
