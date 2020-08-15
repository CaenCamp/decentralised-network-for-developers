import React from 'react';
import { Edit, SimpleForm, TextInput, required } from 'react-admin';

const VideoTitle = ({ record }) =>
    record ? `Edition de ${record.id}` : null;

export const VideoEdit = (props) => {
    return (
        <Edit title={<VideoTitle />} {...props}>
            <SimpleForm>
                <TextInput
                    fullWidth
                    label="Description"
                    source="abstract"
                    validate={required()}
                />
            </SimpleForm>
        </Edit>
    );
};
