import React from 'react';
import { Create,
    SimpleForm,
    TextInput,
    required,
    ReferenceInput,
    SelectInput,
    ReferenceArrayInput,
    SelectArrayInput,
} from 'react-admin';

export const CreativeWorkCreate = (props) => (
    <Create {...props} title="Création d'un talk">
        <SimpleForm>
            <TextInput
                fullWidth
                label="Nom"
                source="name"
                validate={required()}
            />
            <TextInput
                fullWidth
                multiline
                label="Résumé"
                source="disambiguatingDescription"
                validate={required()}
            />
            <TextInput
                fullWidth
                multiline
                label="Présentation"
                source="abstract"
            />
            <ReferenceInput
                label="Type de talk"
                source="learningResourceType"
                reference="learning_resource_types"
                filter={{ typeFor: 'creative-work' }}
                validate={required()}
            >
                <SelectInput optionText="name" optionValue="name" />
            </ReferenceInput>
            <TextInput
                fullWidth
                label="Url de l'image"
                source="image"
            />
            <TextInput
                fullWidth
                label="Langue"
                source="inLanguage"
            />
            <ReferenceInput label="Support" source="encoding" reference="media_objects">
                <SelectInput optionText="abstract" />
            </ReferenceInput>
            <ReferenceInput label="Vidéo" source="video" reference="video_objects">
                <SelectInput optionText="abstract" />
            </ReferenceInput>
            <ReferenceArrayInput label="Mainteneurs" source="maintainers" reference="people">
                <SelectArrayInput optionText="name" />
            </ReferenceArrayInput>
        </SimpleForm>
    </Create>
);
