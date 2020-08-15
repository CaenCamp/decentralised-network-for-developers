import React from 'react';
import { Edit, SimpleForm, TextInput, required, ReferenceInput, SelectInput } from 'react-admin';

const MediaTitle = ({ record }) =>
    record ? `Edition de ${record.id}` : null;

export const MediaEdit = (props) => {
    return (
        <Edit title={<MediaTitle />} {...props}>
            <SimpleForm>
                <TextInput
                    fullWidth
                    label="Description"
                    source="abstract"
                    validate={required()}
                />
                <ReferenceInput
                    label="Type de support"
                    source="learningResourceType"
                    reference="learning_resource_types"
                    filter={{ typeFor: 'media-object' }}
                >
                    <SelectInput optionText="name" optionValue="name" />
                </ReferenceInput>
                <TextInput
                    fullWidth
                    label="Url du support"
                    source="contentUrl"
                    validate={required()}
                />
                <ReferenceInput label="Talk du support" source="encodesCreativeWork" reference="creative_works">
                    <SelectInput optionText="name" />
                </ReferenceInput>
            </SimpleForm>
        </Edit>
    );
};
