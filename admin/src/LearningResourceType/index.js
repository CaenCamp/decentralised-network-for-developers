import LearningResourceTypeIcon from '@material-ui/icons/Build';
import { LearningResourceTypeList } from './List';
import { LearningResourceTypeCreate } from './Create';
import { LearningResourceTypeEdit } from './Edit';

export const typeForChoices = [
    { id: 'creativeWork', name: 'Talk' },
    { id: 'creativeWorkMaterial', name: 'Support de présentation' },
];

export default {
    list: LearningResourceTypeList,
    create: LearningResourceTypeCreate,
    edit: LearningResourceTypeEdit,
    icon: LearningResourceTypeIcon,
    options: { label: 'Les types de ressources' }
};
