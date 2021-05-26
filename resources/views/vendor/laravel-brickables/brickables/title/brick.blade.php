<x-front.title :typeKey="$brick['data']['type']"
               :styleKey="$brick['data']['style']"
                {{-- ToDo: replace `translatedData` by `data_get` if your app is not multilingual --}}
               :title="translatedData($brick, 'data.title')"/>
