<template>
    <div class="column">
        <span class="title">Create Column</span>
        <form @submit.prevent="submit" class="form">
            <input
                class="input"
                type="text"
                v-model="form.title"
                placeholder="Column title" />
            <button type="submit" class="button">Create</button>
        </form>
    </div>
</template>

<script>
import { useForm } from "@inertiajs/vue2";

export default {
    setup() {
        const form = useForm({
            title: "",
        });

        const submit = () => {
            form.post("/columns", {
                preserveScroll: true,
                onSuccess: () => {
                    form.reset();
                },
            });
        };

        return {
            form,
            submit,
        };
    },
};
</script>
