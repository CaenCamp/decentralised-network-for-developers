import React from 'react';
import { Edit, SimpleForm, TextInput, SelectInput, required } from 'react-admin';

const LearningResourceTypeTitle = ({ record }) =>
    record ? `Edition de ${record.name}` : null;

export const LearningResourceTypeEdit = (props) => {
    return (
        <Edit title={<LearningResourceTypeTitle />} {...props}>
            <SimpleForm>
                <TextInput
                    fullWidth
                    label="Label"
                    source="name"
                    validate={required()}
                />
                <TextInput
                    fullWidth
                    label="Description"
                    source="abstract"
                    validate={required()}
                />
                <SelectInput source="typeFor" label="Applicable à" choices={[
                    { id: 'creative-work', name: 'Talk' },
                    { id: 'media-object', name: 'Support de présentation' },
                ]} />
            </SimpleForm>
        </Edit>
    );
};
