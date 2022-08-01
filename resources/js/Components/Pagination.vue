<template>
    <div class="flex justify-between border-t border-gray-200">
        <div
            class="text-txtgray flex space-x-1 items-center cursor-pointer"
            @click="$emit('change', page > 1 ? page - 1 : page)"
        >
            <ArrowLeftIcon icon-color="#808080" />
            <div>Previous</div>
        </div>
        <div
            v-if="totalPage <= 5"
            class="flex space-x-6 text-txtgray"
        >
            <PaginationButton
                v-for="(_, index) in [...Array(totalPage)]"
                :key="index"
                :page="index + 1"
                :active="index + 1 === page"
                @change="$emit('change', $event)"
            />
        </div>
        <div v-else class="flex space-x-6 text-txtgray">
            <PaginationButton
                v-if="page < 5"
                v-for="(_, index) in [...Array(Math.min(5, totalPage))]"
                :key="index"
                :page="index + 1"
                :active="index + 1 === page"
                @change="$emit('change', $event)"
            />
            <template v-else>
                <PaginationButton :page="1" @change="$emit('change', $event)" />
                <div class="py-3 px-2 text-txtgray">...</div>
            </template>
            <template v-if="page >= 5 && page <= totalPage - 4">
                <PaginationButton
                    :page="page - 1"
                    @change="$emit('change', $event)"
                />
                <PaginationButton
                    :page="page"
                    :active="true"
                    @change="$emit('change', $event)"
                />
                <PaginationButton
                    :page="page + 1"
                    @change="$emit('change', $event)"
                />
            </template>
            <template v-if="page > totalPage - 4 && page > 4">
                <PaginationButton
                    v-for="(_, index) in [...Array(Math.max(5, totalPage - page))]"
                    :key="totalPage - 4 + index"
                    :page="totalPage - 4 + index"
                    :active="totalPage - 4 + index === page"
                    @change="$emit('change', $event)"
                />
            </template>
            <template v-else>
                <div class="py-3 px-2 text-txtgray">...</div>
                <PaginationButton :page="totalPage" @change="$emit('change', $event)" />
            </template>
        </div>
        <div
            class="text-txtgray flex space-x-1 items-center cursor-pointer"
            @click="$emit('change', page < totalPage ? page + 1 : page)"
        >
            <div>Next</div>
            <ArrowRightIcon icon-color="#808080" />
        </div>
    </div>
</template>
<script>
import ArrowLeftIcon from '@/Components/FormBuilder/Icons/ArrowLeftIcon'
import ArrowRightIcon from '@/Components/FormBuilder/Icons/ArrowRightIcon'
import PaginationButton from '@/Components/PaginationButton'
export default {
    components: { PaginationButton, ArrowRightIcon, ArrowLeftIcon },
    props: {
        totalPage: {
            type: Number,
            default: 10
        },
        page: {
            type: Number,
            default: 1
        }
    },
    emits: ['change']
}
</script>
