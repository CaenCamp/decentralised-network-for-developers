import VideoIcon from '@material-ui/icons/VideoLibrary';
import { VideoList } from './List';
import { VideoCreate } from './Create';
import { VideoEdit } from './Edit';

export default {
    list: VideoList,
    create: VideoCreate,
    edit: VideoEdit,
    icon: VideoIcon,
    options: { label: 'Les vidéos' }
};
