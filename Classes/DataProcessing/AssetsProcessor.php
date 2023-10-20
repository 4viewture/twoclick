<?php

declare(strict_types=1);

namespace FourViewture\TwoClick\DataProcessing;

use TYPO3\CMS\Core\Page\AssetCollector;
use TYPO3\CMS\Core\Page\AssetRenderer;
use TYPO3\CMS\Frontend\ContentObject\ContentDataProcessor;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

class AssetsProcessor implements DataProcessorInterface
{
    protected static array $assetCollectorState = [];

    public function __construct(
        protected readonly ContentDataProcessor $contentDataProcessor,
        protected AssetCollector $assetCollector
    )
    {
    }

    /**
     * Process content object data
     *
     * @param ContentObjectRenderer $cObj The data of the content element or page
     * @param array $contentObjectConfiguration The configuration of Content Object
     * @param array $processorConfiguration The configuration of this processor
     * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
     * @return array the processed data as key/value store
     */
    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ): array
    {
        $targetVariableName = $cObj->stdWrapValue('as', $processorConfiguration, 'assetState');
        $data = null;

        switch ($processorConfiguration['mode'] ?? null) {
            case 'saveState':
                $data = $this->saveAssetCollectorState();
                break;
            case 'cleanUpAssetCollector':
                $data = $this->cleanUpAssetCollector();
                break;
            case 'addScriptAndCssInlineWithAssetRenderer':
                $data = $this->addScriptAndCssInlineWithAssetRenderer();
                break;
            case 'restoreState':
                $this->restoreAssetCollectorState();
                break;
            default:
                // throw new \Exception(print_r($processorConfiguration, true));
        }

        if ($data !== null) {
            $processedData[$targetVariableName] = $data;
        }

        return $processedData;
    }

    protected function saveAssetCollectorState(): void
    {
        static::$assetCollectorState = $this->assetCollector->getState();
    }

    protected function cleanUpAssetCollector(): void
    {
        $this->assetCollector->updateState(
            [
                'javaScripts' => [],
                'inlineJavaScripts' => [],
                'styleSheets' => [],
                'inlineStyleSheets' => [],
                'media' => [],
            ]
        );
    }

    protected function addScriptAndCssInlineWithAssetRenderer(): string
    {
        $assetRenderer = new AssetRenderer($this->assetCollector);
        return implode(
            PHP_EOL,
            [
                $assetRenderer->renderStyleSheets(),
                $assetRenderer->renderInlineStyleSheets(),
                $assetRenderer->renderJavaScript(),
                $assetRenderer->renderInlineJavaScript()
            ]
        );
    }

    protected function restoreAssetCollectorState(): void
    {
        $this->assetCollector->updateState(static::$assetCollectorState);
    }
}
